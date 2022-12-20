
class Token{

	isValid(token){
		const payoad = this.payload(token)
		if(payoad){
			return payoad.iss = 'http://127.0.0.1:8000/api/auth/login' || 'http://127.0.0.1:8000/api/auth/register' ? true : false;
		}

		return false;
	}

	payload(token){
		const payoad = token.split('.')[1];
		return this.decode(payoad);
	}

	decode(payoad){
		return JSON.parse(atob(payoad));
	}
	
}

export default Token = new Token() 