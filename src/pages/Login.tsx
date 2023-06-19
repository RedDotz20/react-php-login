import { useState } from 'react';

type eventType = { preventDefault: () => void };

export default function Login() {
	const [username, setUsername] = useState('');
	const [password, setPassword] = useState('');

	const handleLogin = async (e: eventType) => {
		e.preventDefault();
		try {
			// const response = await axios.post('/api/login.php', {
			// 	username,
			// 	password,
			// });
			// console.log(response.data);
			console.log('submit response');
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
