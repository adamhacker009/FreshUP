import h5py
import numpy as np
import sys
import json

def parse(file_path):
    with h5py.File(file_path, 'r') as f:
        nh3_data = f['NH3_Mixing_Ratio_Surrogate'][:]
        lat = f['Latitude'][:]
        lon = f['Longitude'][:]
        time = f.attrs['Time'][0]

    avg_nh3 = np.nanmean(nh3_data) * 1e9

    return {
        'pollutant_type': 'NH3',
        'value': float(avg_nh3),
        'latitude': float(np.mean(lat)),
        'longitude': float(np.mean(lon)),
        'measured_at': time.decode('utf-8')
    }

if __name__ == "__main__":
    result = parse(sys.argv[1])
    print(json.dumps(result))
