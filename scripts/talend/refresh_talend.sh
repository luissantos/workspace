#!/bin/bash

# Deletes Talend cache jar files

TALEND_HOME="/Users/luissantos/Development/TOS_DI-20151214_1327-V6.1.1"

rm -R -f ~/.m2/repository/org/talend/libraries/migration-lib-*

rm -R -f $TALEND_HOME/workspace/.Java/lib/*.jar


