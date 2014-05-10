# -*- coding: utf-8 -*-
DESC = u"줄 끝에 오는 공백 무시"

def judge(data_dir, input_path, output_path, expected_path):
    import os, sys

    # print >> sys.stderr, os.path.splitext( output_path )[0].lower(), expected_path.lower()

    return os.path.splitext( os.path.basename( output_path ) )[0].lower() == expected_path.lower()

