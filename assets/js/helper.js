function attachToWindow(components) {
    Object.keys(components).forEach((key) => {
        window[key] = components[key];
    });
}

export { 
    attachToWindow,
};