--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.3
-- Dumped by pg_dump version 9.5.3

-- Started on 2016-08-01 13:16:00

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12355)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2101 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 181 (class 1259 OID 16401)
-- Name: browsershare; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE browsershare (
    browser character(30),
    shareval character(20)
);


ALTER TABLE browsershare OWNER TO postgres;

--
-- TOC entry 2093 (class 0 OID 16401)
-- Dependencies: 181
-- Data for Name: browsershare; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY browsershare (browser, shareval) FROM stdin;
Chrome                        	69                  
Firefox                       	18.6                
IE                            	6.2                 
Safari                        	3.7                 
Opera                         	1.3                 
\.


--
-- TOC entry 2100 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2016-08-01 13:16:00

--
-- PostgreSQL database dump complete
--

