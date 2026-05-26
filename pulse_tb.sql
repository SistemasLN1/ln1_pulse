--
-- PostgreSQL database dump
--

\restrict FbgdEtouaVy3A7qQUYzKEBWbLmHNi3SXE720X03AuEHqMeeihO7qYi7JdWQxXHb

-- Dumped from database version 18.3
-- Dumped by pg_dump version 18.3

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: incidencia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.incidencia (
    id_incidencia integer NOT NULL,
    id_proyecto integer NOT NULL,
    id_usuario integer NOT NULL,
    id_sprint integer NOT NULL,
    nombre character varying(255),
    descripcion text,
    tipo character varying(100),
    estado character varying(100),
    puntos_historia integer,
    prioridad character varying(50),
    fecha_creacion timestamp without time zone,
    fecha_cierre timestamp without time zone
);


ALTER TABLE public.incidencia OWNER TO postgres;

--
-- Name: incidencia_id_incidencia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.incidencia ALTER COLUMN id_incidencia ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.incidencia_id_incidencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: incidencia_log; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.incidencia_log (
    id_log_incidencia integer NOT NULL,
    id_incidencia integer NOT NULL,
    id_log_sincronizacion integer NOT NULL,
    accion character varying(100),
    datos_antes json,
    datos_despues json,
    origen_sincronizacion character varying(100),
    fecha_sincronizacion timestamp without time zone
);


ALTER TABLE public.incidencia_log OWNER TO postgres;

--
-- Name: incidencia_log_id_log_incidencia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.incidencia_log ALTER COLUMN id_log_incidencia ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.incidencia_log_id_log_incidencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: log_aplicacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.log_aplicacion (
    id_log_aplicacion integer NOT NULL,
    id_log_sincronizacion integer NOT NULL,
    id_proyecto integer NOT NULL,
    id_usuario integer NOT NULL,
    nivel character varying(50),
    modulo character varying(100),
    mensaje text,
    detalle text,
    contexto json,
    fecha_generada timestamp without time zone
);


ALTER TABLE public.log_aplicacion OWNER TO postgres;

--
-- Name: log_aplicacion_id_log_aplicacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.log_aplicacion ALTER COLUMN id_log_aplicacion ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.log_aplicacion_id_log_aplicacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: log_sincronizacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.log_sincronizacion (
    id_log_sincronizacion integer NOT NULL,
    id_proyecto integer NOT NULL,
    id_integracion integer NOT NULL,
    tipo character varying(100),
    estado character varying(50),
    registros_sincronizacion integer,
    registros_error integer,
    detalle_error text,
    fecha_inicio timestamp without time zone,
    fecha_fin timestamp without time zone
);


ALTER TABLE public.log_sincronizacion OWNER TO postgres;

--
-- Name: log_sincronizacion_id_log_sincronizacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.log_sincronizacion ALTER COLUMN id_log_sincronizacion ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.log_sincronizacion_id_log_sincronizacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: sprint; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sprint (
    id_sprint integer NOT NULL,
    id_proyecto integer NOT NULL,
    id_usuario integer NOT NULL,
    nombre character varying(150),
    fecha_inicio date,
    fecha_fin date,
    estado character varying(50)
);


ALTER TABLE public.sprint OWNER TO postgres;

--
-- Name: sprint_alertas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sprint_alertas (
    id_alertas integer NOT NULL,
    id_sprint integer NOT NULL,
    id_proyecto integer NOT NULL,
    id_usuario integer NOT NULL,
    tipo character varying(100),
    mensaje text,
    umbral double precision,
    progreso_actual double precision,
    estado boolean,
    fecha_generada timestamp without time zone
);


ALTER TABLE public.sprint_alertas OWNER TO postgres;

--
-- Name: sprint_alertas_id_alertas_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.sprint_alertas ALTER COLUMN id_alertas ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.sprint_alertas_id_alertas_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: sprint_grafico; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sprint_grafico (
    id_sprint_grafico integer NOT NULL,
    id_sprint integer NOT NULL,
    fecha date,
    puntos_restantes integer,
    puntos_ideales integer,
    puntos_realizados integer,
    estado character varying(50)
);


ALTER TABLE public.sprint_grafico OWNER TO postgres;

--
-- Name: sprint_grafico_id_sprint_grafico_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.sprint_grafico ALTER COLUMN id_sprint_grafico ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.sprint_grafico_id_sprint_grafico_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: sprint_id_sprint_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.sprint ALTER COLUMN id_sprint ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.sprint_id_sprint_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: sprint_metrica; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sprint_metrica (
    id_sprint_metrica integer NOT NULL,
    id_sprint integer NOT NULL,
    id_proyecto integer NOT NULL,
    puntos_completado integer,
    puntos_totales integer,
    velocidad double precision,
    porcentaje_completado double precision,
    fecha_registro date
);


ALTER TABLE public.sprint_metrica OWNER TO postgres;

--
-- Name: sprint_metrica_id_sprint_metrica_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.sprint_metrica ALTER COLUMN id_sprint_metrica ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.sprint_metrica_id_sprint_metrica_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: sprint_tarea; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sprint_tarea (
    id_sprint_tarea integer NOT NULL,
    id_sprint integer NOT NULL,
    id_incidencia integer,
    id_proyecto integer NOT NULL,
    id_usuario integer NOT NULL,
    nombre character varying(200),
    estado character varying(50),
    puntos_historia integer,
    fecha_creacion timestamp without time zone,
    fecha_cierre timestamp without time zone
);


ALTER TABLE public.sprint_tarea OWNER TO postgres;

--
-- Name: sprint_tarea_id_sprint_tarea_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.sprint_tarea ALTER COLUMN id_sprint_tarea ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.sprint_tarea_id_sprint_tarea_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Data for Name: incidencia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.incidencia (id_incidencia, id_proyecto, id_usuario, id_sprint, nombre, descripcion, tipo, estado, puntos_historia, prioridad, fecha_creacion, fecha_cierre) FROM stdin;
\.


--
-- Data for Name: incidencia_log; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.incidencia_log (id_log_incidencia, id_incidencia, id_log_sincronizacion, accion, datos_antes, datos_despues, origen_sincronizacion, fecha_sincronizacion) FROM stdin;
\.


--
-- Data for Name: log_aplicacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.log_aplicacion (id_log_aplicacion, id_log_sincronizacion, id_proyecto, id_usuario, nivel, modulo, mensaje, detalle, contexto, fecha_generada) FROM stdin;
\.


--
-- Data for Name: log_sincronizacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.log_sincronizacion (id_log_sincronizacion, id_proyecto, id_integracion, tipo, estado, registros_sincronizacion, registros_error, detalle_error, fecha_inicio, fecha_fin) FROM stdin;
\.


--
-- Data for Name: sprint; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sprint (id_sprint, id_proyecto, id_usuario, nombre, fecha_inicio, fecha_fin, estado) FROM stdin;
\.


--
-- Data for Name: sprint_alertas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sprint_alertas (id_alertas, id_sprint, id_proyecto, id_usuario, tipo, mensaje, umbral, progreso_actual, estado, fecha_generada) FROM stdin;
\.


--
-- Data for Name: sprint_grafico; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sprint_grafico (id_sprint_grafico, id_sprint, fecha, puntos_restantes, puntos_ideales, puntos_realizados, estado) FROM stdin;
\.


--
-- Data for Name: sprint_metrica; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sprint_metrica (id_sprint_metrica, id_sprint, id_proyecto, puntos_completado, puntos_totales, velocidad, porcentaje_completado, fecha_registro) FROM stdin;
\.


--
-- Data for Name: sprint_tarea; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sprint_tarea (id_sprint_tarea, id_sprint, id_incidencia, id_proyecto, id_usuario, nombre, estado, puntos_historia, fecha_creacion, fecha_cierre) FROM stdin;
\.


--
-- Name: incidencia_id_incidencia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.incidencia_id_incidencia_seq', 1, false);


--
-- Name: incidencia_log_id_log_incidencia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.incidencia_log_id_log_incidencia_seq', 1, false);


--
-- Name: log_aplicacion_id_log_aplicacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.log_aplicacion_id_log_aplicacion_seq', 1, false);


--
-- Name: log_sincronizacion_id_log_sincronizacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.log_sincronizacion_id_log_sincronizacion_seq', 1, false);


--
-- Name: sprint_alertas_id_alertas_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sprint_alertas_id_alertas_seq', 1, false);


--
-- Name: sprint_grafico_id_sprint_grafico_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sprint_grafico_id_sprint_grafico_seq', 1, false);


--
-- Name: sprint_id_sprint_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sprint_id_sprint_seq', 1, false);


--
-- Name: sprint_metrica_id_sprint_metrica_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sprint_metrica_id_sprint_metrica_seq', 1, false);


--
-- Name: sprint_tarea_id_sprint_tarea_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sprint_tarea_id_sprint_tarea_seq', 1, false);


--
-- Name: incidencia_log incidencia_log_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.incidencia_log
    ADD CONSTRAINT incidencia_log_pkey PRIMARY KEY (id_log_incidencia);


--
-- Name: incidencia incidencia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.incidencia
    ADD CONSTRAINT incidencia_pkey PRIMARY KEY (id_incidencia);


--
-- Name: log_aplicacion log_aplicacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.log_aplicacion
    ADD CONSTRAINT log_aplicacion_pkey PRIMARY KEY (id_log_aplicacion);


--
-- Name: log_sincronizacion log_sincronizacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.log_sincronizacion
    ADD CONSTRAINT log_sincronizacion_pkey PRIMARY KEY (id_log_sincronizacion);


--
-- Name: sprint_alertas sprint_alertas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint_alertas
    ADD CONSTRAINT sprint_alertas_pkey PRIMARY KEY (id_alertas);


--
-- Name: sprint_grafico sprint_grafico_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint_grafico
    ADD CONSTRAINT sprint_grafico_pkey PRIMARY KEY (id_sprint_grafico);


--
-- Name: sprint_metrica sprint_metrica_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint_metrica
    ADD CONSTRAINT sprint_metrica_pkey PRIMARY KEY (id_sprint_metrica);


--
-- Name: sprint sprint_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint
    ADD CONSTRAINT sprint_pkey PRIMARY KEY (id_sprint);


--
-- Name: sprint_tarea sprint_tarea_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint_tarea
    ADD CONSTRAINT sprint_tarea_pkey PRIMARY KEY (id_sprint_tarea);


--
-- Name: incidencia_log fk_il_incidencia; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.incidencia_log
    ADD CONSTRAINT fk_il_incidencia FOREIGN KEY (id_incidencia) REFERENCES public.incidencia(id_incidencia) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: incidencia_log fk_il_log_sincronizacion; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.incidencia_log
    ADD CONSTRAINT fk_il_log_sincronizacion FOREIGN KEY (id_log_sincronizacion) REFERENCES public.log_sincronizacion(id_log_sincronizacion) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: incidencia fk_inc_sprint; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.incidencia
    ADD CONSTRAINT fk_inc_sprint FOREIGN KEY (id_sprint) REFERENCES public.sprint(id_sprint) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: log_aplicacion fk_la_log_sincronizacion; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.log_aplicacion
    ADD CONSTRAINT fk_la_log_sincronizacion FOREIGN KEY (id_log_sincronizacion) REFERENCES public.log_sincronizacion(id_log_sincronizacion) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: sprint_alertas fk_sa_sprint; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint_alertas
    ADD CONSTRAINT fk_sa_sprint FOREIGN KEY (id_sprint) REFERENCES public.sprint(id_sprint) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: sprint_grafico fk_sg_sprint; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint_grafico
    ADD CONSTRAINT fk_sg_sprint FOREIGN KEY (id_sprint) REFERENCES public.sprint(id_sprint) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: sprint_metrica fk_sm_sprint; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint_metrica
    ADD CONSTRAINT fk_sm_sprint FOREIGN KEY (id_sprint) REFERENCES public.sprint(id_sprint) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: sprint_tarea fk_st_incidencia; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint_tarea
    ADD CONSTRAINT fk_st_incidencia FOREIGN KEY (id_incidencia) REFERENCES public.incidencia(id_incidencia) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: sprint_tarea fk_st_sprint; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sprint_tarea
    ADD CONSTRAINT fk_st_sprint FOREIGN KEY (id_sprint) REFERENCES public.sprint(id_sprint) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- PostgreSQL database dump complete
--

\unrestrict FbgdEtouaVy3A7qQUYzKEBWbLmHNi3SXE720X03AuEHqMeeihO7qYi7JdWQxXHb

