const availableTailwindSafeClasses = [
    {
        pattern: /^-?m([lrtb])?-/
    },
    {
        pattern: /^(bg|text|border|ring|divide|placeholder)-((primary|danger|warning|success|info)|[a-z]+-\d{1,3})-?$/
    },
];

export default availableTailwindSafeClasses;