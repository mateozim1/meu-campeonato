import React from 'react';

const Campeonato = () => {
  const campeonatos = [
    { id: 1, nome: 'Campeonato 2020', vencedor: 'Time A' },
    { id: 2, nome: 'Campeonato 2021', vencedor: 'Time B' },
  ];

  return (
    <div>
      <h2>Campeonato</h2>
      <ul>
        {campeonatos.map(campeonato => (
          <li key={campeonato.id}>
            <strong>{campeonato.nome}</strong> - Vencedor: {campeonato.vencedor}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default Campeonato;