-- Table: public.capital_pool_events

-- DROP TABLE public.capital_pool_events;

CREATE TABLE public.capital_pool_events
(
    id bigint NOT NULL DEFAULT nextval('capital_pool_events_id_seq'::regclass),
    platform character varying(16) COLLATE pg_catalog."default" NOT NULL,
    channel character varying(64) COLLATE pg_catalog."default" NOT NULL,
    action character varying(16) COLLATE pg_catalog."default" NOT NULL,
    amount numeric NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone NOT NULL,
    CONSTRAINT capital_pool_events_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.capital_pool_events
    OWNER to product;