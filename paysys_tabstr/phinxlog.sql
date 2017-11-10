-- Table: public.phinxlog

-- DROP TABLE public.phinxlog;

CREATE TABLE public.phinxlog
(
    version bigint NOT NULL,
    migration_name character varying(100) COLLATE pg_catalog."default",
    start_time timestamp without time zone,
    end_time timestamp without time zone,
    breakpoint boolean NOT NULL DEFAULT false,
    CONSTRAINT phinxlog_pkey PRIMARY KEY (version)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.phinxlog
    OWNER to product;