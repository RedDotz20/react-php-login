import axios from 'axios';
import { useState } from 'react';

type eventType = { preventDefault: () => void }

export default function Login() {
	const [username, setUsername] = useState('');
	const [password, setPassword] = useState('');

	const handleLogin = async (e: eventType) => {
		e.preventDefault();
		try {
			const response = await axios.post('/api/login.php', {
				username,
				password,
			});
			console.log(response.data); // Handle the response as needed
		} catch (error) {
			console.error(error);
		}
	};

	return (
		<div>
			<h2>Login</h2>
			<form onSubmit={handleLogin}>
				<input
					type="text"
					placeholder="Username"
					value={username}
					onChange={(e) => setUsername(e.target.value)}
				/>
				<input
					type="password"
					placeholder="Password"
					value={password}
					onChange={(e) => setPassword(e.target.value)}
				/>
				<button type="submit">Login</button>
			</form>
		</div>
	);
}
