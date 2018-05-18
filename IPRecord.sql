-- Table: "IPRecord"

-- DROP TABLE "IPRecord";

CREATE TABLE "IPRecord"
(
  "memberId" integer NOT NULL DEFAULT 0,
  "memberIp" character varying(255) NOT NULL,
  "blacklistReason" character varying(255),
  banned boolean NOT NULL DEFAULT false
)
WITH (
  OIDS=FALSE
);
ALTER TABLE "IPRecord"
  OWNER TO postgres;
