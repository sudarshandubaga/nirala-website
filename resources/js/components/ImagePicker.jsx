import React, { useEffect, useState } from "react";
import style from "./ImagePicker.module.css";
import { Button, FormCheck, Image as BSImage, Spinner } from "react-bootstrap";
import Cropper from "react-easy-crop";
import { BiCheck } from "react-icons/bi";
import getCroppedImg from "./cropImage";

const ImagePicker = ({
  done,
  image,
  width,
  height,
  cropShape = "rect",
  thumbs = null
}) => {
  const [crop, setCrop] = useState({ x: 0, y: 0 });
  const [zoom, setZoom] = useState(1);
  const [file, setFile] = useState(false);
  const [croppedAreaPixels, setCroppedAreaPixels] = useState(null);
  const [ratio, setRatio] = useState(1);
  const [cropping, setCropping] = useState(false);

  function readFile(file) {
    return new Promise((resolve) => {
      const reader = new FileReader();
      reader.addEventListener("load", () => resolve(reader.result), false);
      reader.readAsDataURL(file);
    });
  }

  function gcd(a, b) {
    return b === 0 ? a : gcd(b, a % b);
  }

  function getRatio(w, h) {
    w = parseFloat(w);
    h = parseFloat(h);
    let r = gcd(w, h);
    let ratioW = w / r,
      ratioH = h / r;

    setRatio(ratioW / ratioH);
  }

  const onDrop = async (e) => {
    e.preventDefault();
    done(null);
    const droppedFiles = e.dataTransfer.files;
    let imageUrl = await readFile(droppedFiles[0]);
    setFile(imageUrl);
  };
  const handleFile = async (e) => {
    const files = e.target.files;
    done(null);
    let imageUrl = await readFile(files[0]);
    setFile(imageUrl);
  };
  const onCropComplete = (croppedArea, croppedAreaPixels) => {
    setCroppedAreaPixels(croppedAreaPixels);
  };

  const resizeImage = (blobURL, width, height) => {
    return new Promise((resolve, reject) => {
      const img = document.createElement("img");
      img.src = blobURL;

      img.onload = () => {
        const canvas = document.createElement("canvas");
        canvas.width = width;
        canvas.height = height;

        const ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, width, height);

        resolve(canvas.toDataURL("image/webp"));
      };

      img.onerror = (err) => {
        reject(err);
      };
    });
  };
  async function blobToDataUrl(blob) {
    return new Promise((r) => {
      let a = new FileReader();
      a.onload = r;
      a.readAsDataURL(blob);
    }).then((e) => e.target.result);
  }
  const doneCropping = async () => {
    setCropping(true);
    try {
      let resType = "base64";
      let croppedImage = await getCroppedImg(
        file,
        croppedAreaPixels,
        {
          width,
          height,
        },
        resType
      );
      setFile(null);



      if (thumbs) {
        let resizeImages = [];
        for (let size of thumbs) {
          let thumbImage = await resizeImage(
            croppedImage,
            size.width,
            size.height
          );
          resizeImages.push({
            label: size.label,
            image: thumbImage,
          });
        }
        croppedImage = resizeImages;
      }
      setCropping(false);
      done(croppedImage);
    } catch (e) {
      console.error("cropping error: ", e);
    }
  };

  useEffect(() => {
    getRatio(width, height);
  }, []);

  return (
    <>
      <label
        className={`${style.dndUpload} text-center`}
        onDrop={onDrop}
        onDragOver={(e) => e.preventDefault()}
      >
        {cropping ? (
          <div>
            <Spinner variant="primary" />
          </div>
        ) : (
          <>
            {file ? (
              <>
                <div
                  style={{
                    height: 200,
                    width: "100%",
                    position: "relative",
                  }}
                >
                  <Cropper
                    image={file}
                    crop={crop}
                    zoom={zoom}
                    onCropChange={setCrop}
                    onCropComplete={onCropComplete}
                    onZoomChange={setZoom}
                    cropShape={cropShape}
                    aspect={ratio ?? 1}
                  />
                </div>
                <Button
                  variant="outline-primary"
                  onClick={() => doneCropping()}
                >
                  <BiCheck /> Crop Image
                </Button>
              </>
            ) : null}

            {image ? (
              <>
                {/* {JSON.stringify(image)} */}
                <BSImage
                  src={
                    Array.isArray(image) ? image[image.length - 1].image : image
                  }
                  fluid
                  className={style.previewImage}
                />
              </>
            ) : null}
            <div>
              <strong>Click</strong> or <strong>Drag &amp; Drop</strong>
              <br />
              files here
              <br />
              <div className="text-secondary fs-1">
                ({`${width} x  ${height}`})
              </div>
            </div>
            {/* <div>Or</div> */}
            <div>
              {/* <label className="btn btn-primary text-white"> */}
              {/* Click to Choose Image */}
              <input
                type="file"
                className="d-none"
                accept="image/*"
                onChange={handleFile}
              />
              {/* </label> */}
            </div>
          </>
        )}
      </label>
    </>
  );
};

export default ImagePicker;
