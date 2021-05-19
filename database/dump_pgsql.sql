CREATE DATABASE users_test_application
  WITH OWNER = postgres
       ENCODING = 'UTF8'
       TABLESPACE = pg_default
       LC_COLLATE = 'Portuguese_Brazil.1252'
       LC_CTYPE = 'Portuguese_Brazil.1252'
       CONNECTION LIMIT = -1;

CREATE TABLE public.users
(
  id integer NOT NULL DEFAULT nextval('users_id_seq'::regclass),
  name character varying(255),
  lastname character varying(255),
  email character varying(255),
  address_street character varying,
  address_number character varying(255),
  address_complement character varying(255),
  address_district character varying(255),
  address_city character varying,
  address_state character varying,
  status boolean DEFAULT true,
  observations text,
  file_address character varying,
  CONSTRAINT users_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.users
  OWNER TO postgres;

CREATE TABLE public.users_history_log
(
  id integer NOT NULL DEFAULT nextval('users_history_log_id_seq'::regclass),
  action character varying(100),
  date_action timestamp without time zone,
  id_user integer,
  CONSTRAINT users_history_log_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.users_history_log
  OWNER TO postgres;
