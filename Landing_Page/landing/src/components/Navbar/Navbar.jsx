import React, { useState, useEffect } from 'react';
import { FaBars, FaTimes } from 'react-icons/fa';
import { IconContext } from "react-icons/lib";
import {
    Nav,
    NavLogo,
    NavIcon,
    NavbarContainer,
    MobileHamburgerIcon,
    NavMenu,
    NavItem,
    NavLinks,
    NavBtnLink,
    NavItemButton
} from "./Navbar.elements";
import { Button } from "../../globalStyles";

export const Navbar = ({onShowSignup}) => {
    const [click, setClick] = useState(false);
    const [button, setButton] = useState(true);
    const showButton = () => {
        if (window.innerWidth <= 960) {
            setButton(false);
        } else {
            setButton(true);
        }
    }

    // set button initally and on re-render
    useEffect(() => {
        showButton();
    }, []);

    // re-render on resize
    window.addEventListener('resize', showButton);

    const handleClick = () => setClick(!click);

    return(
        <>
            <IconContext.Provider value={{ color: '#fff' }}>
                <Nav>
                    <NavbarContainer>
                        <NavLogo to="/">
                            <NavIcon />
                            RealDeal
                        </NavLogo>
                        <MobileHamburgerIcon
                            onClick={handleClick}
                        >
                            {click ? <FaTimes/> : <FaBars/>}
                        </MobileHamburgerIcon>

                        <NavMenu
                            onClick={handleClick}
                            click={click}
                        >
                            <NavItem>
                                <NavLinks to="/about">O programie</NavLinks>
                            </NavItem>

                            <NavItem>
                                <NavLinks to="/signup">Zapisz się</NavLinks>
                            </NavItem>

                            <NavItem>
                                <NavLinks to="/pricing">Ceny</NavLinks>
                            </NavItem>

                            {/* button (list element) */}
                            <NavItemButton>
                                {button ? (<NavBtnLink to="/signup">
                                    <Button primary onClick={onShowSignup}>Zapisz się</Button>
                                </NavBtnLink>) :
                                    (
                                <NavBtnLink to="/sign-up">
                                    <Button fontBig primary
                                        onClick={onShowSignup}
                                    >
                                        Zapisz się
                                    </Button>
                                </NavBtnLink>
                                )}
                            </NavItemButton>
                        </NavMenu>

                    </NavbarContainer>
                </Nav>
           </IconContext.Provider>
        </>
    );
}
