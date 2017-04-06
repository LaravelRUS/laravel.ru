import React, { Component } from 'react'
import { NavLink } from 'react-router-dom'
import classNames from 'classnames'
import { LaravelIcon, MenuIcon } from 'components/Icons'

class Header extends Component {
  state = {
    isMenuOpened: false
  }

  handleMenuClick = () => {
    this.setState({ isMenuOpened: !this.state.isMenuOpened })
  }

  render() {
    const navigationClassName = classNames('navigation', {
      opened: this.state.isMenuOpened
    })

    return (
      <header className="laravel-header">
        <div className="contents">
          <div className="logo">
            <NavLink to="/" exact>
              <LaravelIcon />
              <div className="logo-subtext">
                <p>Laravel</p>
                <p>Русское сообщество</p>
              </div>
            </NavLink>
          </div>
          <div className="menu">
            <button onClick={this.handleMenuClick}>
              <MenuIcon />
            </button>
          </div>
          <div className={navigationClassName}>
            <ul>
              <li><NavLink to="/docs">Документация</NavLink></li>
              <li><NavLink to="/articles">Статьи</NavLink></li>
              <li><NavLink to="/jobs">Работа</NavLink></li>
              <li><NavLink to="/karma">Карма</NavLink></li>
              <li><NavLink to="/packages">Пакеты</NavLink></li>
              {/* <li><NavLink to="#">Вконтакте</NavLink></li> */}
              <li><NavLink to="#">Чат</NavLink></li>
              {/* <li><NavLink to="/search">Поиск</NavLink></li> */}
              {/* <li><NavLink to="#">Tips</NavLink></li> */}
              {/* <li><NavLink to="/login">Login</NavLink></li> */}
            </ul>
          </div>
        </div>
      </header>
    )
  }
}

export default Header
