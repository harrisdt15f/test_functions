-- Table: public.withdrawal_responses

-- DROP TABLE public.withdrawal_responses;

CREATE TABLE public.withdrawal_responses
(
    id bigint NOT NULL DEFAULT nextval('withdrawal_responses_id_seq'::regclass),
    tx_no character varying(128) COLLATE pg_catalog."default" NOT NULL,
    no character varying(32) COLLATE pg_catalog."default" NOT NULL,
    platform character varying(16) COLLATE pg_catalog."default" NOT NULL,
    channel character varying(64) COLLATE pg_catalog."default" NOT NULL,
    status character varying(16) COLLATE pg_catalog."default" NOT NULL,
    form jsonb NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone NOT NULL,
    CONSTRAINT withdrawal_responses_pkey PRIMARY KEY (id),
    CONSTRAINT withdrawal_responses_no FOREIGN KEY (no)
        REFERENCES public.withdrawal_slips (no) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.withdrawal_responses
    OWNER to product;

-- Index: withdrawal_responses_no_status

-- DROP INDEX public.withdrawal_responses_no_status;

CREATE UNIQUE INDEX withdrawal_responses_no_status
    ON public.withdrawal_responses USING btree
    (no COLLATE pg_catalog."default", status COLLATE pg_catalog."default")
    TABLESPACE pg_default;

-- Index: withdrawal_responses_tx_no

-- DROP INDEX public.withdrawal_responses_tx_no;

CREATE INDEX withdrawal_responses_tx_no
    ON public.withdrawal_responses USING btree
    (tx_no COLLATE pg_catalog."default")
    TABLESPACE pg_default;