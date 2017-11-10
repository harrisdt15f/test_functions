-- Table: public.capital_pool_deposits

-- DROP TABLE public.capital_pool_deposits;

CREATE TABLE public.capital_pool_deposits
(
    id bigint NOT NULL DEFAULT nextval('capital_pool_deposits_id_seq'::regclass),
    capital_pool_event_id bigint NOT NULL,
    deposit_slip_id bigint NOT NULL,
    CONSTRAINT capital_pool_deposits_pkey PRIMARY KEY (id),
    CONSTRAINT capital_pool_deposits_capital_pool_event_id FOREIGN KEY (capital_pool_event_id)
        REFERENCES public.capital_pool_events (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT capital_pool_deposits_deposit_slip_id FOREIGN KEY (deposit_slip_id)
        REFERENCES public.deposit_slips (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.capital_pool_deposits
    OWNER to product;