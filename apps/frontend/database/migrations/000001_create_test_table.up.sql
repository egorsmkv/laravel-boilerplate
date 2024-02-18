-- format using https://sqlfum.pt
-- or
-- cat 000001_create_test_table.up.sql | cockroach sqlfmt --print-width 40

CREATE TABLE test1 (
    id UUID NOT NULL,
    city STRING NOT NULL,
    type STRING,
    owner_id UUID,
    creation_time TIMESTAMP,
    status STRING,
    current_location STRING,
    ext JSONB,
    CONSTRAINT "primary" PRIMARY KEY (city ASC, id ASC),
    INDEX index_status (status),
    INVERTED INDEX ix_vehicle_ext (ext),
    FAMILY "primary" (id, city, type, owner_id, creation_time, status, current_location, ext)
);
