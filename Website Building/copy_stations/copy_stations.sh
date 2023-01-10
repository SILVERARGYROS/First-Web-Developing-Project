#!/bin/sh

HOSTNAME=localhost
DATABASE=db1u10
USERNAME=db1u10
export PGPASSWORD=k2ts1k0.

psql -h $HOSTNAME -U $USERNAME $DATABASE < copy_stations/copy_stations.txt