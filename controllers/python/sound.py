import numpy as np
import sys, warnings, os, json, math, cv2
import tensorflow as tf
from tensorflow.keras import backend as K
from tensorflow.keras.models import load_model
import librosa
import librosa.display
import pylab

def warn(*args, **kwargs): pass
warnings.warn = warn
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '3'
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '2'
np.random.seed(1)

def recall_m(y_true, y_pred):
  true_positives = K.sum(K.round(K.clip(y_true * y_pred, 0, 1)))
  possible_positives = K.sum(K.round(K.clip(y_true, 0, 1)))
  recall = true_positives / (possible_positives + K.epsilon())
  return recall

def precision_m(y_true, y_pred):
  true_positives = K.sum(K.round(K.clip(y_true * y_pred, 0, 1)))
  predicted_positives = K.sum(K.round(K.clip(y_pred, 0, 1)))
  precision = true_positives / (predicted_positives + K.epsilon())
  return precision

def f1_m(y_true, y_pred):
  precision = precision_m(y_true, y_pred)
  recall = recall_m(y_true, y_pred)
  return 2*((precision*recall)/(precision+recall+K.epsilon()))

try:
  args = sys.argv

  hdf5 = args[1]      # Path to the HDF5 file.
  soundPath = args[2]   # Path to the sound.
  labelsPath = args[3]  # File of labels.

  f = open(labelsPath, "r")
  labels = f.readlines()
  for i in range(len(labels)):
    labels[i] = labels[i].strip()
  f.close()
  
  sampleLocation = os.path.join(os.getcwd(), "temp.jpg")
  audio, sr = librosa.load(soundPath)
  S = librosa.feature.melspectrogram(y=audio, sr=sr)
  pylab.axis("off")
  pylab.axes([0., 0., 1., 1.], frameon=False, xticks=[], yticks=[])
  librosa.display.specshow(librosa.power_to_db(S, ref=np.max))
  pylab.savefig(sampleLocation, bbox_inches=None, pad_inches=0)
  pylab.close()

  dependencies = {
          'recall_m': recall_m,
          'precision_m': precision_m,
          'f1_m': f1_m,
  }

  model = load_model(hdf5, custom_objects=dependencies)
  inputLayer = model.layers[0]
  width, height, channels = inputLayer.input_shape[1:]
  if (channels == 1):
    image = cv2.imread(sampleLocation, cv2.IMREAD_GRAYSCALE)
  else:
    image = cv2.imread(sampleLocation)

  image = cv2.resize(image, (width, height), interpolation=cv2.INTER_AREA)
  image = np.array(image, dtype='float32') / 255.0
  image = image.reshape(-1, width, height, channels)

  predictions = model.predict(image)[0]
  predictions = (predictions * 100.0) / sum(predictions)
  predictions = [int(e * 10000.0) / 10000.0 for e in predictions]
  predictions = predictions[:3]
  output = list(zip(labels, predictions))
  output = list(sorted(output, key=lambda x: x[1], reverse=True))
  print(json.dumps(output))

except Exception as ex:
  print(ex)
