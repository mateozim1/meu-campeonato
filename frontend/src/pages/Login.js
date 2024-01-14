import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';  // Importe o CSS do Bootstrap

const Login = () => {
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');
    const navigate = useNavigate();

    const handleLogin = () => {
        // Adicione lógica de autenticação aqui (por exemplo, enviar dados para um servidor)
        // Este exemplo apenas navega para a página inicial
        navigate('/home');
    };

    return (
        <div className="container d-flex justify-content-center align-items-center mt-5">
            <div className="col-md-3 mt-5">
                <h2 className="mb-4 text-center">Login</h2>
                <form>
                    <div className="mb-3">
                        <input type="text" className="form-control" id="username" value={username} onChange={(e) => setUsername(e.target.value)} placeholder='Email' />
                    </div>
                    <div className="mb-3">
                        <input type="password" className="form-control" id="password" value={password} onChange={(e) => setPassword(e.target.value)} placeholder='Senha' />
                    </div>
                    <div className="text-center">
                        <button type="button" className="btn btn-primary w-100" onClick={handleLogin}>
                            Entrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    );
};

export default Login;