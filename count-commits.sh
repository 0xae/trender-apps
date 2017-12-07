#!/usr/bin/env bash
git log | grep Date | awk '{print $2 " " $3 " "  $4}' | uniq -c
