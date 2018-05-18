-- Table: "IPRecord"

-- DROP TABLE "IPRecord";

CREATE TABLE "IPRecord"
(
  "memberIp" character varying(255) NOT NULL,
  "blacklistReason" character varying(255) NOT NULL DEFAULT 'None'::character varying,
  banned boolean NOT NULL DEFAULT false,
  "memberId" serial NOT NULL,
  id serial NOT NULL,
  CONSTRAINT "IPRecord_pkey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE "IPRecord"
  OWNER TO postgres;
