#!/bin/bash

sed -e "s/__tb_prefix__/$3/g" scheme.sql > tmp
mysql -u$1 -p$2 $3 < tmp
