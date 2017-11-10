-- Table: public.capital_pool_channel_snapshots

-- DROP TABLE public.capital_pool_channel_snapshots;

CREATE TABLE public.capital_pool_channel_snapshots
(
    id bigint NOT NULL DEFAULT nextval('capital_pool_channel_snapshots_id_seq'::regclass),
    channel character varying(16) COLLATE pg_catalog."default" NOT NULL,
    balance numeric NOT NULL,
    platform_balances jsonb NOT NULL,
    capital_pool_event_id bigint NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone NOT NULL,
    CONSTRAINT capital_pool_channel_snapshots_pkey PRIMARY KEY (id),
    CONSTRAINT capital_pool_channel_snapshots_capital_pool_event_id FOREIGN KEY (capital_pool_event_id)
        REFERENCES public.capital_pool_events (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.capital_pool_channel_snapshots
    OWNER to product;