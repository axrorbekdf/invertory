
class AppStorage{

	storeToken(token){
		localStorage.setItem('token', token);
	}

	storeUser(user){
		localStorage.setItem('user', user);
	}

	getToken(){
		localStorage.getItem('token');
	}

	getUser(){
		localStorage.getItem('user');
	}

	store(token, user){
		this.storeToken(token);
		this.storeUser(user);
	}

	clear(){
		localStorage.removeItem('token');
		localStorage.removeItem('user');
	}
}

export default AppStorage = new AppStorage() 