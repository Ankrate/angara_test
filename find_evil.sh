#!/bin/bash
find . -name "*.php" -exec grep "base64" '{}' \; -print &> b64-detections.txt
find . -name "*.php" -exec grep "eval" '{}' \; -print &> eval-detections.txt
