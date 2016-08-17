#!/usr/bin/env python

import sys

website_url = sys.argv[1]

with open('file_to_write', 'w') as f:
    f.write(website_url)