-- Table: public.configurations

-- DROP TABLE public.configurations;

CREATE TABLE public.configurations
(
    id integer NOT NULL DEFAULT nextval('configurations_id_seq'::regclass),
    field character varying(64) COLLATE pg_catalog."default" NOT NULL,
    value jsonb NOT NULL,
    CONSTRAINT configurations_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.configurations
    OWNER to product;