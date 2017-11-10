-- Table: public.deposit_responses

-- DROP TABLE public.deposit_responses;

CREATE TABLE public.deposit_responses
(
    id bigint NOT NULL DEFAULT nextval('deposit_responses_id_seq'::regclass),
    tx_no character varying(128) COLLATE pg_catalog."default" NOT NULL,
    no character varying(32) COLLATE pg_catalog."default" NOT NULL,
    platform character varying(16) COLLATE pg_catalog."default" NOT NULL,
    channel character varying(64) COLLATE pg_catalog."default" NOT NULL,
    status character varying(16) COLLATE pg_catalog."default" NOT NULL,
    form jsonb NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone NOT NULL,
    CONSTRAINT deposit_responses_pkey PRIMARY KEY (id),
    CONSTRAINT deposit_responses_no FOREIGN KEY (no)
        REFERENCES public.deposit_slips (no) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.deposit_responses
    OWNER to product;

-- Index: deposit_responses_no_status

-- DROP INDEX public.deposit_responses_no_status;

CREATE UNIQUE INDEX deposit_responses_no_status
    ON public.deposit_responses USING btree
    (no COLLATE pg_catalog."default", status COLLATE pg_catalog."default")
    TABLESPACE pg_default;

-- Index: deposit_responses_tx_no

-- DROP INDEX public.deposit_responses_tx_no;

CREATE INDEX deposit_responses_tx_no
    ON public.deposit_responses USING btree
    (tx_no COLLATE pg_catalog."default")
    TABLESPACE pg_default;