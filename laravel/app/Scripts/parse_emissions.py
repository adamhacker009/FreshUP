import sys
import json
import os

def parse_csv(path):
    # Примерная заглушка
    return {"type": "csv", "nh3_avg": 42.0}

def parse_hdf(path):
    return {"type": "hdf", "nh3_avg": 50.1}

def parse_nc(path):
    return {"type": "nc", "nh3_avg": 47.5}

if __name__ == "__main__":
    file_path = sys.argv[1]
    ext = sys.argv[2]

    if ext == "csv":
        result = parse_csv(file_path)
    elif ext == "hdf":
        result = parse_hdf(file_path)
    elif ext == "nc":
        result = parse_nc(file_path)
    else:
        raise ValueError("Unsupported file type")

    with open("storage/app/emissions.json", "w") as f:
        json.dump(result, f)
