tailwind.config = {
  theme: {
    fontFamily: {
      sans: ["Plus Jakarta Sans", "system-ui"],
      serif: ["Plus Jakarta Sans", "Georgia"],
      mono: ["ui-monospace", "SFMono-Regular"],
      display: ["Plus Jakarta Sans"],
      body: ['"Plus Jakarta Sans"'],
    },
    container: {
      center: true,

      screens: {
        sm: "600px",
        md: "728px",
        lg: "984px",
        xl: "1280px",
        "2xl": "1740px",
      },
    },
    extend: {
      colors: {
        primary: "#302828",
        secondary: "#ffffff",
        gray: "#B1B5C3",
        third: "#292930",
        box: "#edf1f0",
        pink: "#FF497C",
        detail: "#E6DFD7",

        customGray: "#828282",
      },
      fontSize: {
        span: "12px",
        p: "16px",
        h1: "36px",
        h2: "20px",
        h3: "26px",
        button: "18px",
        small: "14px",
      },
      borderRadius: {
        20: "20px",
        15: "15px",
        box: "10px",
        button: "5px",
      },
    },
  },
};
