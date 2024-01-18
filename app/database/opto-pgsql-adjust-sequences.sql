SELECT setval('agenda_id_seq', coalesce(max(id),0) + 1, false) FROM agenda;
SELECT setval('cad_paciente_id_seq', coalesce(max(id),0) + 1, false) FROM cad_paciente;
SELECT setval('lan_avaliacao_id_seq', coalesce(max(id),0) + 1, false) FROM lan_avaliacao;