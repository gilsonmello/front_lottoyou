import Vue from 'vue'

Vue.prototype.removeRepeatedNumbers = function(numbers, value) {
	for(var i = 0; i < numbers.length; i++) {
		for(var j = i + 1; j < numbers.length; j++){
			if(numbers[i] == numbers[j]) {
				numbers[i] = Math.floor(Math.random()*this.dickers.length) + 1;
				this.removeRepeatedNumbers(numbers)
			}
		}
	}
	return numbers;
};