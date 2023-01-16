#!/bin/sh

HOSTNAME=localhost
DATABASE=db1u10
USERNAME=db1u10
export PGPASSWORD=grnphkk774

psql -h $HOSTNAME -U $USERNAME $DATABASE < copy_fires/copy_fires.txt