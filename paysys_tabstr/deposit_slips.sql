-- Table: public.deposit_slips

-- DROP TABLE public.deposit_slips;

CREATE TABLE public.deposit_slips
(
    id bigint NOT NULL DEFAULT nextval('deposit_slips_id_seq'::regclass),
    no character varying(32) COLLATE pg_catalog."default" NOT NULL,
    order_no character varying(64) COLLATE pg_catalog."default" NOT NULL,
    amount numeric NOT NULL,
    platform character varying(16) COLLATE pg_catalog."default" NOT NULL,
    channel character varying(64) COLLATE pg_catalog."default" NOT NULL DEFAULT ''::character varying,
    gateway character varying(32) COLLATE pg_catalog."default" NOT NULL,
    bank character varying(8) COLLATE pg_catalog."default" NOT NULL DEFAULT ''::character varying,
    ip character varying(39) COLLATE pg_catalog."default" NOT NULL DEFAULT ''::character varying,
    status character varying(16) COLLATE pg_catalog."default" NOT NULL DEFAULT 'created'::character varying,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone NOT NULL,
    fee numeric NOT NULL DEFAULT 0,
    extra character varying(512) COLLATE pg_catalog."default" NOT NULL DEFAULT ''::character varying,
    CONSTRAINT deposit_slips_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.deposit_slips
    OWNER to product;

-- Index: deposit_slips_no

-- DROP INDEX public.deposit_slips_no;

CREATE UNIQUE INDEX deposit_slips_no
    ON public.deposit_slips USING btree
    (no COLLATE pg_catalog."default")
    TABLESPACE pg_default;

-- Index: deposit_slips_platform_order_no

-- DROP INDEX public.deposit_slips_platform_order_no;

CREATE UNIQUE INDEX deposit_slips_platform_order_no
    ON public.deposit_slips USING btree
    (platform COLLATE pg_catalog."default", order_no COLLATE pg_catalog."default")
    TABLESPACE pg_default;