const timeouts = {};

const debounce = (callback, delay, key) => {
    if (timeouts[key] !== null) {
        clearTimeout(timeouts[key])
    }

    timeouts[key] = setTimeout(() => {
        callback();
        timeouts[key] = null;
    }, delay)
};

export {debounce};
