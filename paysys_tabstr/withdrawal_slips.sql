-- Table: public.withdrawal_slips

-- DROP TABLE public.withdrawal_slips;

CREATE TABLE public.withdrawal_slips
(
    id bigint NOT NULL DEFAULT nextval('withdrawal_slips_id_seq'::regclass),
    no character varying(32) COLLATE pg_catalog."default" NOT NULL,
    order_no character varying(64) COLLATE pg_catalog."default" NOT NULL,
    amount numeric NOT NULL,
    bank character varying(8) COLLATE pg_catalog."default" NOT NULL,
    bank_province character varying(32) COLLATE pg_catalog."default" NOT NULL DEFAULT ''::character varying,
    bank_city character varying(32) COLLATE pg_catalog."default" NOT NULL DEFAULT ''::character varying,
    bank_branch character varying(64) COLLATE pg_catalog."default" NOT NULL DEFAULT ''::character varying,
    card_no character varying(32) COLLATE pg_catalog."default" NOT NULL,
    card_holder character varying(32) COLLATE pg_catalog."default" NOT NULL,
    holder_phone character varying(16) COLLATE pg_catalog."default" NOT NULL DEFAULT ''::character varying,
    holder_id character varying(32) COLLATE pg_catalog."default" NOT NULL DEFAULT ''::character varying,
    platform character varying(16) COLLATE pg_catalog."default" NOT NULL,
    channel character varying(64) COLLATE pg_catalog."default" NOT NULL DEFAULT ''::character varying,
    ip character varying(39) COLLATE pg_catalog."default" NOT NULL DEFAULT ''::character varying,
    status character varying(16) COLLATE pg_catalog."default" NOT NULL DEFAULT 'created'::character varying,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone NOT NULL,
    fee numeric NOT NULL DEFAULT 0,
    extra character varying(512) COLLATE pg_catalog."default" NOT NULL DEFAULT ''::character varying,
    CONSTRAINT withdrawal_slips_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.withdrawal_slips
    OWNER to product;

-- Index: withdrawal_slips_no

-- DROP INDEX public.withdrawal_slips_no;

CREATE UNIQUE INDEX withdrawal_slips_no
    ON public.withdrawal_slips USING btree
    (no COLLATE pg_catalog."default")
    TABLESPACE pg_default;

-- Index: withdrawal_slips_platform_order_no

-- DROP INDEX public.withdrawal_slips_platform_order_no;

CREATE UNIQUE INDEX withdrawal_slips_platform_order_no
    ON public.withdrawal_slips USING btree
    (platform COLLATE pg_catalog."default", order_no COLLATE pg_catalog."default")
    TABLESPACE pg_default;