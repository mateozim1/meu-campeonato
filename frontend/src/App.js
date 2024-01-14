import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Login from './pages/Login';
import Home from './pages/Home';
import Time from './pages/Time';
import Historico from './pages/Historico';
import Campeonato from './pages/Campeonato';

const App = () => {
    return (
        <Router>
            <Routes>
                <Route path="/" element={<Login />} />
                <Route path="/home" element={<Home />} />
                <Route path="/campeonato" element={<Campeonato />} />
                <Route path="/historico" element={<Historico />} />
                <Route path="/times" element={<Time />} />
            </Routes>
        </Router>
    );
};

export default App;
