import React from 'react';

const Historico = () => {
  const historico = [
    { id: 1, nome: 'Campeonato 2020', vencedor: 'Time A' },
    { id: 2, nome: 'Campeonato 2021', vencedor: 'Time B' },
  ];

  return (
    <div>
      <h2>Histórico de Campeonatos</h2>
      <ul>
        {historico.map(campeonato => (
          <li key={campeonato.id}>
            <strong>{campeonato.nome}</strong> - Vencedor: {campeonato.vencedor}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default Historico;