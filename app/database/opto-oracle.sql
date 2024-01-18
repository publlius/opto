CREATE TABLE agenda( 
      id number(10)    NOT NULL , 
      horario_inicial timestamp(0)    NOT NULL , 
      horario_final timestamp(0)    NOT NULL , 
      titulo varchar(3000)   , 
      cor varchar(3000)   , 
      observacao varchar(3000)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cad_paciente( 
      id number(10)    NOT NULL , 
      nome varchar  (255)    NOT NULL , 
      sobrenome varchar  (255)    DEFAULT NULL , 
      data_nascimento date    DEFAULT NULL , 
      numero_rg varchar  (255)    NOT NULL , 
      numero_cpf varchar  (255)    NOT NULL , 
      cidade varchar  (255)    DEFAULT NULL , 
      endereco_residencial varchar  (255)    DEFAULT NULL , 
      bairro_residencial varchar  (255)    DEFAULT NULL , 
      referencia_residencial varchar  (255)    DEFAULT NULL , 
      endereco_comercial varchar  (255)    DEFAULT NULL , 
      fone_01 varchar  (255)    DEFAULT NULL , 
      observacoes varchar(3000)    DEFAULT NULL , 
      criado_em timestamp(0)    DEFAULT NULL , 
      atualizado_em timestamp(0)    DEFAULT NULL , 
      criado_por_id number(10)  (11)    DEFAULT NULL , 
      atualizado_por_id number(10)  (11)    DEFAULT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE lan_avaliacao( 
      id number(10)    NOT NULL , 
      data_avaliacao date    NOT NULL , 
      cad_paciente_id number(10)    NOT NULL , 
      idade_atual varchar  (255)    NOT NULL , 
      anamnese varchar(3000)    NOT NULL , 
      avsc_longe_1 varchar  (255)    DEFAULT NULL , 
      avsc_perto_1 varchar  (255)    DEFAULT NULL , 
      avsc_ph_1 varchar  (255)    DEFAULT NULL , 
      avsc_longe_2 varchar  (255)    DEFAULT NULL , 
      avsc_perto_2 varchar  (255)    DEFAULT NULL , 
      avsc_ph_2 varchar  (255)    DEFAULT NULL , 
      avsc_longe_3 varchar  (255)    DEFAULT NULL , 
      avsc_perto_3 varchar  (255)    DEFAULT NULL , 
      avsc_ph_3 varchar  (255)    DEFAULT NULL , 
      ref_pup_1 varchar  (255)    DEFAULT NULL , 
      ref_pup_2 varchar  (255)    DEFAULT NULL , 
      ref_pup_3 varchar  (255)    DEFAULT NULL , 
      kappa_od_1 varchar  (255)    DEFAULT NULL , 
      kappa_od_2 varchar  (255)    DEFAULT NULL , 
      kappa_oe_1 varchar  (255)    DEFAULT NULL , 
      kappa_oe_2 varchar  (255)    DEFAULT NULL , 
      hischberg varchar  (255)    DEFAULT NULL , 
      ct_06m_01 varchar  (255)    DEFAULT NULL , 
      ct_06m_02 varchar  (255)    DEFAULT NULL , 
      ct_40m_01 varchar  (255)    DEFAULT NULL , 
      ct_40m_02 varchar  (255)    DEFAULT NULL , 
      ct_20m_01 varchar  (255)    DEFAULT NULL , 
      ct_20m_02 varchar  (255)    DEFAULT NULL , 
      ct_outro_01 varchar  (255)    DEFAULT NULL , 
      ct_outro_02 varchar  (255)    DEFAULT NULL , 
      fo_od varchar  (255)    DEFAULT NULL , 
      fo_od_fixacao varchar  (255)    DEFAULT NULL , 
      fo_oe varchar  (255)    DEFAULT NULL , 
      fo_oe_fixacao varchar  (255)    DEFAULT NULL , 
      ret_estat_01 varchar  (255)    DEFAULT NULL , 
      ret_estat_02 varchar  (255)    DEFAULT NULL , 
      ret_estat_03 varchar  (255)    DEFAULT NULL , 
      ret_estat_04 varchar  (255)    DEFAULT NULL , 
      ret_estat_05 varchar  (255)    DEFAULT NULL , 
      ret_estat_06 varchar  (255)    DEFAULT NULL , 
      ret_estat_07 varchar  (255)    DEFAULT NULL , 
      ret_estat_08 varchar  (255)    DEFAULT NULL , 
      auto_01 varchar  (255)    DEFAULT NULL , 
      auto_02 varchar  (255)    DEFAULT NULL , 
      auto_03 varchar  (255)    DEFAULT NULL , 
      auto_04 varchar  (255)    DEFAULT NULL , 
      auto_05 varchar  (255)    DEFAULT NULL , 
      auto_06 varchar  (255)    DEFAULT NULL , 
      auto_07 varchar  (255)    DEFAULT NULL , 
      auto_08 varchar  (255)    DEFAULT NULL , 
      subjetivo_01 varchar  (255)    DEFAULT NULL , 
      subjetivo_02 varchar  (255)    DEFAULT NULL , 
      subjetivo_03 varchar  (255)    DEFAULT NULL , 
      subjetivo_04 varchar  (255)    DEFAULT NULL , 
      subjetivo_05 varchar  (255)    DEFAULT NULL , 
      subjetivo_06 varchar  (255)    DEFAULT NULL , 
      subjetivo_07 varchar  (255)    DEFAULT NULL , 
      subjetivo_08 varchar  (255)    DEFAULT NULL , 
      afinam_01 varchar  (255)    DEFAULT NULL , 
      afinam_02 varchar  (255)    DEFAULT NULL , 
      afinam_03 varchar  (255)    DEFAULT NULL , 
      afinam_04 varchar  (255)    DEFAULT NULL , 
      afinam_05 varchar  (255)    DEFAULT NULL , 
      afinam_06 varchar  (255)    DEFAULT NULL , 
      afinam_07 varchar  (255)    DEFAULT NULL , 
      afinam_08 varchar  (255)    DEFAULT NULL , 
      rx_final_ad varchar  (255)    DEFAULT NULL , 
      diag_refrativo_od varchar  (255)    DEFAULT NULL , 
      diag_refrativo_oe varchar  (255)    DEFAULT NULL , 
      diag_motor_od varchar  (255)    DEFAULT NULL , 
      diag_motor_oe varchar  (255)    DEFAULT NULL , 
      diag_patologico_od varchar  (255)    DEFAULT NULL , 
      diag_patologico_oe varchar  (255)    DEFAULT NULL , 
      contuta_refrativa varchar  (255)    DEFAULT NULL , 
      contuta_motora varchar  (255)    DEFAULT NULL , 
      contuta_patologica varchar  (255)    DEFAULT NULL , 
      observacoes varchar(3000)    DEFAULT NULL , 
      criado_em timestamp(0)    DEFAULT NULL , 
      criado_por_id number(10)  (11)    DEFAULT NULL , 
      atualizado_em timestamp(0)    DEFAULT NULL , 
      atualizado_por_id number(10)  (11)    DEFAULT NULL , 
 PRIMARY KEY (id)) ; 

 
  
 ALTER TABLE lan_avaliacao ADD CONSTRAINT fk_lan_avaliacao_1 FOREIGN KEY (cad_paciente_id) references cad_paciente(id); 
 CREATE SEQUENCE agenda_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER agenda_id_seq_tr 

BEFORE INSERT ON agenda FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT agenda_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE cad_paciente_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER cad_paciente_id_seq_tr 

BEFORE INSERT ON cad_paciente FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT cad_paciente_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE lan_avaliacao_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER lan_avaliacao_id_seq_tr 

BEFORE INSERT ON lan_avaliacao FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT lan_avaliacao_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
 
  
