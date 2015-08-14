import postal from 'postal'
import requertResponse from 'postal.request-response'
import postalSurvivableEvent from 'postal-survivable-event'

import Q from './Q.js'

requertResponse(postal);
postalSurvivableEvent(postal);

var channel = postal.channel('modulbank.channel');

postal.configuration.promise.createDeferred = function () {
	return Q.defer();
};
postal.configuration.promise.getPromise = function (dfd) {
	return dfd.promise;
};

var wrapper = function (func) {
	if (func === undefined)
		return func;

	return function(){
		var args = arguments;
		var self = this;
		setTimeout(function(){
			wrapedCallback.apply(self,args);
		},0);
	}

	function wrapedCallback() {
		var envelope = arguments[arguments.length - 1];
		if (envelope.reply) {
			try {
				return Q(func.apply(null, arguments[0])).then(function (result) {
					envelope.reply(null, result);
				}, function (error) {
					error = !!error ? error : 'unknown error';
					console.warn(error);
					envelope.reply(error);
				});
			}
			catch (e) {
				console.error(e);
				return envelope.reply(e);
			}
		}
		return func.apply(null, arguments);
	}
};

export default {

	/**
	 * Публикация события в шину
	 * @param event Имя события, например user.created
	 * @param data Данные
	 */
		publish(event, data){
		channel.publish(event, data);
	},

	/**
	 * Публикация события в шину
	 * @param event Имя события, например user.created
	 * @param data Данные
	 */
		document(event, data){
		channel.document(event, data);
	},

	/**
	 * Подписка на событие
	 * @param event Имя события, на которое осуществляется подписка, например user.created
	 * @param func Функцмя, которая будет вызвана при получении события
	 * @returns {*} Объект, который может быть передан в функцию unsubscribe для отписки
	 */
		subscribe(event, func) {
		if (typeof func !== 'function') {
			throw '`func` parameter must be function';
		}
		return channel.subscribe(event, wrapper(func));
	},
	/**
	 * Отписка от события, по объекту полученному при вызове функции  subscribe
	 * @param subscription
	 */
		unsubscribe(subscription) {
		if (subscription.unsubscribe)
			subscription.unsubscribe();
	},
	request() {
		return channel.request({topic: arguments[0], data: Array.prototype.slice.call(arguments, 1)});
	}
}