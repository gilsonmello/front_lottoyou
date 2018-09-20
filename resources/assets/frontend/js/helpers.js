import Vue from 'vue'
import {routes} from './api_routes';

Number.prototype.format = function(n, x) {
    var re = '(\\d)(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$1,');
};

Vue.prototype.makeid = function() {
	var text = "";
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	for (var i = 0; i < 15; i++){
	  text += possible.charAt(Math.floor(Math.random() * possible.length));
	}
  return text;
};

Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key);
};

Vue.prototype.src = function(src) {
	return src.replace(' ', '%20');
};

Vue.prototype.$eventBus = new Vue();

Vue.prototype.app = window.app;

Vue.prototype.app.reload = function() {
	window.location.reload();
}

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

Vue.prototype.scrollToTop = function() {
	var height = $('main').prop('scrollHeight');
    $('html, body').animate({
        scrollTop: 0
    },  300);
};

Vue.prototype.countdown = function(date, callback) {
	
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

	return [d, h, m, s, distance];
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

Vue.prototype.refreshAuth = function(params) {
	params = params != undefined ? params : {}
	//Token de acesso
	var access_token = JSON.parse(window.localStorage.getItem('access_token'));
	access_token = access_token != null ? access_token : null;

	//Token para refresh
	var refresh_token = JSON.parse(window.localStorage.getItem('refresh_token'));
	refresh_token = refresh_token != null ? refresh_token : '';

	var authRequest = axios.create();

	authRequest.interceptors.request.use(config => {
		if(params.onBefore != undefined && typeof params.onBefore == 'function') {
			params.onBefore();
		}
		return config;
	});
	//Fazendo busca do usuário logado, para setar na estrutura de dados
	authRequest.get(routes.auth.user, { headers: {
		'Accept': 'application/json',
		'Authorization': 'Bearer ' + access_token
	}}).then(response => {
		if(response.status === 200) {
        	response.data.access_token = access_token
        	response.data.refresh_token = refresh_token
			//window.localStorage.setItem('authUser', JSON.stringify(response.data))
			this.$store.dispatch('setUserObject', response.data);

			if(params.onSuccess != undefined && typeof params.onSuccess == 'function') {
				params.onSuccess();
			}
		}
    }).catch((error) => {
		if(params.onError != undefined && typeof params.onError == 'function') {
			params.onError();
		}
    });
};

Vue.prototype.refreshAuthPromise = function() {
	//Token de acesso
	let access_token = JSON.parse(window.localStorage.getItem('access_token'));
	access_token = access_token != null ? access_token : null;

	//Token para refresh
	let refresh_token = JSON.parse(window.localStorage.getItem('refresh_token'));
	refresh_token = refresh_token != null ? refresh_token : '';

	let authRequest = axios.create();

	authRequest.interceptors.request.use(config => {
		return config;
	});
	//Fazendo busca do usuário logado, para setar na estrutura de dados
	return authRequest.get(routes.auth.user, { headers: {
		'Accept': 'application/json',
		'Authorization': 'Bearer ' + access_token
	}})
};

Vue.prototype.divideInTwo = function(arr) {
	let length = arr.length;

	let arrLeft = [];
	let arrRight = [];

	//Se não tiver itens retorna vazio
	if(length == 0) {
		return [[], []]
	} else if(length == 1) {
		//Se só possui 1 item, retorna a posição 0
		return [
			[
				arr[0]
			], 
			[]
		]
	} else if(length == 2) {
		//Se possui dois itens, retorna a posição 0 e 1
		return [
			[
				arr[0]
			], 
			[
				arr[1]
			]
		]
	} else if((length % 2 == 1)) {

		//Se a quantidade de itens forem impar
		var left = Math.round(length / 2);

		if(left == 0) {
			arrLeft.push(arr[0]);
			return [arrLeft, []];
		} else {
			for (var i = 0; i < left; i++) {
				arrLeft.push(arr[i]);
			}
		}

		var right = left

		if(right == length) {
			arrRight.push(arr[right]);
		} else {
			for(var i = right; i < length; i++) {
				arrRight.push(arr[i]);
			}
		}

		return [arrLeft, arrRight];
	} else if((length % 2 == 0)) {
		//Se a quantidade de itens foram par

		var left = Math.round(length / 2);

		if(left == 0) {
			arrLeft.push(arr[0]);
			return [arrLeft, []];
		} else {
			for (var i = 0; i < left; i++) {
				arrLeft.push(arr[i]);
			}
		}
		
		var right = left

		if(right == length) {
			arrRight.push(arr[right]);
		} else {
			for(var i = right; i < length; i++) {
				arrRight.push(arr[i]);
			}
		}

		return [arrLeft, arrRight];
	}

};


Vue.prototype.validateCPF = function(cpf){

    var numbers, digits, sum, i, result, equal_digits;
    equal_digits = 1;
    cpf = cpf.replace(/\.|\-/g, '');
    if (cpf.length < 11) {
        return false;
    }
    for (i = 0; i < cpf.length - 1; i++)
        if (cpf.charAt(i) != cpf.charAt(i + 1))
        {
            equal_digits = 0;
            break;
        }
    if (!equal_digits)
    {
        numbers = cpf.substring(0,9);
        digits = cpf.substring(9);
        sum = 0;
        for (i = 10; i > 1; i--)
            sum += numbers.charAt(10 - i) * i;
        result = sum % 11 < 2 ? 0 : 11 - sum % 11;
        if (result != digits.charAt(0))
            return false;
        numbers = cpf.substring(0,10);
        sum = 0;
        for (i = 11; i > 1; i--)
            sum += numbers.charAt(11 - i) * i;
        result = sum % 11 < 2 ? 0 : 11 - sum % 11;
        if (result != digits.charAt(1))
            return false;
        return true;
    }
    else
        return false;
};

Vue.prototype.retireHour = function(date) {
	date = date.split(' ');
	return date[0];
};

Vue.prototype.getCountries = (cb) => {
	let countries = [];
	const countryRequest = axios.create();
	countryRequest.interceptors.request.use(config => {
		return config;
	});
	countryRequest.get(routes.countries.index, {}).then(response => {
		if(response.status === 200) {
			countries = response.data;
			cb(countries);
		}
	}).catch((error) => {
		countries = [];
		cb(countries);
	});
}

Vue.prototype.getLeagues = () => {
	return new Promise(function(resolve, reject) {       
		let request = axios.create();
		request.get(routes.leagues.index)
			.then((response) => {
				resolve(response);
			})
			.catch((error) => {
				reject(error)
			});
	});
};

Vue.prototype.getLeaguesBySlug = (slug) => {
	return new Promise(function(resolve, reject) {       
		let request = axios.create();
		let url = routes.leagues.findBySlug.replace('{slug}', slug);
		request.get(url)
			.then((response) => {
				resolve(response);
			})
			.catch((error) => {
				reject(error)
			});
	});
}

Vue.prototype.getLeagueAwards = (slug) => {
	return new Promise(function(resolve, reject) {       
		let request = axios.create();
		let url = routes.leagues.awards.replace('{slug}', slug);
		request.get(url)
			.then((response) => {
				resolve(response);
			})
			.catch((error) => {
				reject(error)
			});
	});
};

Vue.prototype.getLeaguePackages = () => {
	let auth = window.VueInstance.auth;
	let headers = {	};

	if(auth) {
		headers.headers = {
			'Content-Type' : 'application/json',
			'Accept' : 'application/json',
			'Authorization': 'Bearer ' + auth.access_token
		};
	} 
	return new Promise(function(resolve, reject) {       
		let request = axios.create();
		let url = routes.league_packages.index;
		request.get(url, headers)
			.then((response) => {
				resolve(response);
			})
			.catch((error) => {
				reject(error)
			});
	});
};

Vue.prototype.getLeaguePackagesBySlug = (slug) => {
	return new Promise(function(resolve, reject) {       
		let request = axios.create();
		let url = routes.league_packages.findBySlug.replace('{slug}', slug);
		request.get(url)
			.then((response) => {
				resolve(response);
			})
			.catch((error) => {
				reject(error)
			});
	});
};

Vue.prototype.convertSlug = function (str) {
	str = str.replace(/^\s+|\s+$/g, ''); // trim
	str = str.toLowerCase();

	// remove accents, swap ñ for n, etc
	var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
	var to = "aaaaaeeeeeiiiiooooouuuunc------";
	for (var i = 0, l = from.length; i < l; i++) {
		str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
	}

	str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
		.replace(/\s+/g, '-') // collapse whitespace and replace by -
		.replace(/-+/g, '-'); // collapse dashes

	return str;
};

//Ajax para buscar todos pacotes que contém ligas
Vue.prototype.getLeaguesOfPackageBySlug = function(slug) {
	return new Promise(function(resolve, reject) {       
		let request = axios.create();
		let url = routes.league_packages.find_leagues_by_slug.replace('{slug}', slug);
		request.get(url)
			.then((response) => {
				resolve(response);
			})
			.catch((error) => {
				reject(error)
			});
	});
};

Vue.prototype.showModalLogin = () => {
	$('.modal-login').modal('toggle');
};

Vue.prototype.teamRequest = () => {
	let auth = window.VueInstance.auth;
	let headers = {	};

	if(auth) {
		headers.headers = {
			'Content-Type' : 'application/json',
			'Accept' : 'application/json',
			'Authorization': 'Bearer ' + auth.access_token
		};
	} 

	//Requisição para pegar os itens do carrinho salvo
	let teamRequest = axios.create();

	teamRequest.interceptors.request.use(config => {
		return config;
	});

	let url = routes.cartola.find_team_by_slug;
	//Executando a requisição
	return teamRequest.post(url, {
		slug: window.VueInstance.auth.cartoleando_team.slug
	}, headers);
};


//Ajax para buscar todas as configurações do sistema
Vue.prototype.getSystemSettings = function(slug) {
	return new Promise(function(resolve, reject) {       
		let request = axios.create();
		let url = routes.system.settings.index;
		request.get(url)
			.then((response) => {
				resolve(response);
			})
			.catch((error) => {
				reject(error)
			});
	});
	
};

