import { axiosInstance } from './axios';

interface userType {
	username: string;
	password: string;
}

export async function LoginUser(values: userType) {
	await axiosInstance
		.post(`/login.php`, {
			username: values.username,
			password: values.password,
		})
		.catch((err) => console.error(err));
}
