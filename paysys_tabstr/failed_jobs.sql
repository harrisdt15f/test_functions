-- Table: public.failed_jobs

-- DROP TABLE public.failed_jobs;

CREATE TABLE public.failed_jobs
(
    id bigint NOT NULL DEFAULT nextval('failed_jobs_id_seq'::regclass),
    connection text COLLATE pg_catalog."default" NOT NULL,
    queue text COLLATE pg_catalog."default" NOT NULL,
    payload text COLLATE pg_catalog."default" NOT NULL,
    exception text COLLATE pg_catalog."default" NOT NULL,
    failed_at timestamp(0) without time zone NOT NULL DEFAULT ('now'::text)::timestamp(0) with time zone,
    CONSTRAINT failed_jobs_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.failed_jobs
    OWNER to product;