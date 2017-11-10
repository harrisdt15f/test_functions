-- Table: public.migrations

-- DROP TABLE public.migrations;

CREATE TABLE public.migrations
(
    id integer NOT NULL DEFAULT nextval('migrations_id_seq'::regclass),
    migration character varying(255) COLLATE pg_catalog."default" NOT NULL,
    batch integer NOT NULL,
    CONSTRAINT migrations_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.migrations
    OWNER to product;