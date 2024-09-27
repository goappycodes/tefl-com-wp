const ThemeService = {
    /**
   * Saves the website colors to a cookie.
   */
    saveColors() {
        let colors = document.querySelector("body").dataset.colors;
        if (!CookieService.getCookie("site-colors")) {
            CookieService.setCookie("site-colors", colors, 30);
        }
    },
    /**
     * Retrieves the saved website colors from the cookie.
     *
     * @returns {Object} - The saved colors in JSON format or null if no colors are saved.
     */
    getSavedColors() {
        const savedColors = JSON.parse(CookieService.getCookie('site-colors'));
        return savedColors ? JSON.parse(savedColors) : false;
    },
    /**
     * Converts a hexadecimal color code to an RGB value.
     *
     * @param {string} color - The hexadecimal color code, for example "#FF0000".
     * @returns {string} - The RGB value, for example "rgb(255, 0, 0)".
     */
    hexToRgb(color) {
        if (!/^#[0-9A-F]{6}$/i.test(color)) {
            return;
        }

        let hex = color.startsWith("#") ? color.slice(1) : color;
        let r = parseInt(hex.substring(0, 2), 16);
        let g = parseInt(hex.substring(2, 4), 16);
        let b = parseInt(hex.substring(4, 6), 16);

        return `rgb(${r}, ${g}, ${b})`;
    },
    /**
     * Sets the background color of HTML elements to a gradient of the given RGB color.
     *
     * @param {string} colorRGB - The RGB color value, for example "rgb(255, 0, 0)".
     * @param {number} colorStep - The step size for the gradient.
     * @param {jQuery} htmlBlocks - The HTML elements to set the background color of.
     * @param {string} action - The type of gradient, either "increasing" or "decreasing".
     */
    setBgColor(colorRGB, colorStep, htmlBlocks, action) {
        let [r, g, b] = colorRGB.slice(4, -1).split(',').map(Number);

        htmlBlocks.each(function (index) {
            let newR, newG, newB;

            switch (action) {
                case 'decreasing':
                    newR = r + (255 - r) * colorStep * index;
                    newG = g + (255 - g) * colorStep * index;
                    newB = b + (255 - b) * colorStep * index;
                    break;
                case 'increasing':
                    newR = r * (1 + colorStep * index);
                    newG = g * (1 + colorStep * index);
                    newB = b * (1 + colorStep * index);
                    break;
                default:
                    return;
            }

            // Ensure RGB values are within the range 0-255
            newR = Math.min(255, Math.max(0, Math.round(newR)));
            newG = Math.min(255, Math.max(0, Math.round(newG)));
            newB = Math.min(255, Math.max(0, Math.round(newB)));

            $(this).css('backgroundColor', `rgb(${newR}, ${newG}, ${newB})`);
        });
    }
}




