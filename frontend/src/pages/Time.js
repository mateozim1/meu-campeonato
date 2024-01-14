import React from 'react';

const Time = () => {
  const times = [
    { id: 1, nome: 'Campeonato 2020', vencedor: 'Time A' },
    { id: 2, nome: 'Campeonato 2021', vencedor: 'Time B' },
  ];

  return (
    <div>
      <h2>Cadastro de Times</h2>
      <ul>
        {times.map(campeonato => (
          <li key={campeonato.id}>
            <strong>{campeonato.nome}</strong> - Vencedor: {campeonato.vencedor}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default Time;