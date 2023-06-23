import { useState } from 'react';
import { loginUser } from '../api/login';

type eventType = { preventDefault: () => void };

export default function Login() {
	const [username, setUsername] = useState('');
	const [password, setPassword] = useState('');
	const values = { username: username, password: password };

	const handleLogin = async (e: eventType) => {
		e.preventDefault();
		try {
			await loginUser(values);
		} catch (error) {
			console.error(error);
		}
	};

	return (
		<div>
			<h2>Login</h2>
			<form
				onSubmit={handleLogin}
				style={{ display: 'flex', flexDirection: 'column', gap: '0.5rem' }}
			>
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
