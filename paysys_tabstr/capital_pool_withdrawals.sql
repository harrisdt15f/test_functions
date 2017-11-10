-- Table: public.capital_pool_withdrawals

-- DROP TABLE public.capital_pool_withdrawals;

CREATE TABLE public.capital_pool_withdrawals
(
    id bigint NOT NULL DEFAULT nextval('capital_pool_withdrawals_id_seq'::regclass),
    capital_pool_event_id bigint NOT NULL,
    withdrawal_slip_id bigint NOT NULL,
    CONSTRAINT capital_pool_withdrawals_pkey PRIMARY KEY (id),
    CONSTRAINT capital_pool_withdrawals_capital_pool_event_id FOREIGN KEY (capital_pool_event_id)
        REFERENCES public.capital_pool_events (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT capital_pool_withdrawals_withdrawal_slip_id FOREIGN KEY (withdrawal_slip_id)
        REFERENCES public.withdrawal_slips (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.capital_pool_withdrawals
    OWNER to product;