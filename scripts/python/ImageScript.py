from PIL import Image
# from pathlib import Path
# Path('./crop').mkdir(parents=True, exist_ok=True)
# Save to folder ./crop
# cropped_image.save('./crop/crop.png')


"""
    @class ImageManipulation
    @params [image, logo]
    @description modifies images to GrayScale & adds logo to it.

    @return a grayScale image with a logo added to it.
"""


class ImageManipulation:

    image = ''
    logo = ''

    def __init__(self, image, logo):
        self.image = image
        self.logo = logo

    def convertToGray(self, image, name):
        img_gray = image.convert('L')
        img_gray.save(name)
        return name

    def addLogo(self, gray_image, logo):
        image = Image.open(gray_image)
        image_copy = image.copy()
        position = ((image_copy.width - logo.width),
                    (image_copy.height - logo.height))
        image.paste(logo, position)
        image.save(imgNameToSave)


# image to modify goes here...
image = Image.open('bike.jpg')

# logo to add goes here...
logo = Image.open('logo.jpg')

# the name of the image to save after modification.
imgNameToSave = 'gray_bike_logo.jpg'

manipulate = ImageManipulation(image, logo)

gray_image = manipulate.convertToGray(image, imgNameToSave)
manipulate.addLogo(gray_image, logo)
