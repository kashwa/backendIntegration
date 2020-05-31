from PIL import Image
# from pathlib import Path
# Path('./crop').mkdir(parents=True, exist_ok=True)
# Save to folder ./crop
# cropped_image.save('./crop/crop.png')


def convertToGray(image, name):
    img_gray = image.convert('L')
    img_gray.save(name)
    return name


def addLogo(gray_image, logo):
    image = Image.open(gray_image)
    image_copy = image.copy()
    position = ((image_copy.width - logo.width),
                (image_copy.height - logo.height))
    image.paste(logo, position)
    path = "C:\\xampp\\htdocs\\backendIntegration\\storage\\images\\"
    path += imgNameToSave
    image.save(path)


try:
    # image to modify goes here...
    image = Image.open(
        'C:\\xampp\\htdocs\\backendIntegration\\public\\scripts\\python\\bike.jpg')

    # logo to add goes here...
    logo = Image.open(
        'C:\\xampp\\htdocs\\backendIntegration\\public\\scripts\\python\\logo.jpg')

    # the name of the image to save after modification.
    imgNameToSave = 'gray_bike_logo.jpg'

    gray_image = convertToGray(image, imgNameToSave)
    addLogo(gray_image, logo)
except Exception as e:
    print(e)
