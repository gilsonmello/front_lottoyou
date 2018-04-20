import Vue from 'vue'

/*Vue.prototype.removeRepeatedNumbers = function(numbers, value) {
	for(var i = 0; i < numbers.length; i++) {
		for(var j = i + 1; j < numbers.length; j++){
			if(numbers[i] == numbers[j]) {
				numbers[i] = Math.floor(Math.random()*this.dickers.length) + 1;
				this.removeRepeatedNumbers(numbers)
			}
		}
	}
	return numbers;
};*/

var countdown = Vue.prototype.countdown = function(date, callback) {
	
	var now = new Date();	
	
	var eventDate = new Date(date);

	var currentTime = now.getTime();
	var eventTime = eventDate.getTime();

	var distance = eventTime - currentTime;

	var s = Math.floor(distance / 1000);

	var m = Math.floor(s / 60);
	var h = Math.floor(m / 60);
	var d = Math.floor(h / 24);
	
	
	h %= 24;
	s %= 60;
	m %= 60;

	h = (h < 10) ? "0"+ h : h;
	s = (s < 10) ? "0"+ s : s;
	m = (m < 10) ? "0"+ m : m;
	
	if(callback != undefined && typeof callback === 'function')
		callback(d, h, m, s, distance);
}

Vue.prototype.formatDate = function(dateBR) {

	var date = dateBR.split('/');
	var day = date[0];
	var month = parseInt(date[1]);
	var year = date[2].split(' ')[0];

	var arrHour = date[2].split(' ')[1].split(':');

	var hour = arrHour[0];
	var minute = arrHour[1];

	return year +'-'+ month +'-'+day +' '+hour +':'+minute;
};